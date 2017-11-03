<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('object',ChoiceType::class,[

            'choices'=>[
                        'Informations'=>'INF',
                        'Réservations'=>'RES',
                        'Réclamations'=>'REC'
                       ],
            'choices_as_values'=>true,'multiple'=>false,'expanded'=>true


        ])



                ->add('firstname',TextType::class,
                    [
                        'constraints'=>[new NotBlank(['message'=>'*Le champ prénom est obligatoire']),
                                        new Length(['min'=>3,
                                                    'max'=>40,
                                                    'minMessage'=>'Votre prénom doit contenir au moins {{ limit }} caractères',
                                                    'maxMessage'=>'Votre prénom doiy être inférieur à {{ limit }} caractères'
                                                   ]),
                                        new Regex(['pattern'=>'/^[a-zA-Z]+$/i',
                                                   'message'=>"Votre prénom doit contenir uniquement des lettres"
                                                  ])
                                       ]
                    ])


                ->add('lastname', TextType::class,
                    [
                        'constraints'=>[new NotBlank(['message'=>'*Le champ nom est obligatoire']),
                                        new Length  (['min'=>3,
                                                    'max'=>40,
                                                    'minMessage'=>'Votre nom doit contenir au moins {{ limit }} caractères',
                                                    'maxMessage'=>'Votre nom doit être inférieur à {{ limit }}'
                                                    ]),
                                        new Regex   (['pattern'=>'/^[a-zA-Z]+$/i',
                                                      'message'=>"Votre nom doit contenir que des lettres"
                                                    ])
                                       ]
                    ])



                ->add('email', EmailType::class,
                    [
                        'constraints'=>[new NotBlank(['message'=>'*Le champ email doit être rempli']),
                                        new Length  (['min'=>6,
                                                      'minMessage'=>'Votre adresse email est trop courte'
                                                     ]),
                                        new Email   (['checkHost'=>true,
                                                      'checkMX'  =>true
                                                    ])
                                       ]
                    ])


                ->add('phonenumber', TextType::class,
                       [
                           'constraints'=>[new NotBlank(['message'=>"Vous devez saisir votre numéro d\'appel"]),
                                           new Length  (['min'=>10,
                                                         'max'=>10,
                                                         'minMessage'=>'Le numéro doit contenir {{ limit }} chiffres',
                                                         'maxMessage'=>'Le numéro doit contenir {{ limit }} chiffres'
                                                        ]),
                                           new Regex    (['pattern'=>'/^(\(0\))?[0-9]+$/',
                                                          'message'=>'Le numéro doit contenir que des chiffres'
                                                        ])
                                            ]
                       ])


                ->add('content', TextareaType::class,
                      [
                          'constraints'=>[new NotBlank(['message'=>"Veuillez saisir votre message"]),
                                          new Length  (['min'=>100,
                                                        'minMessage'=>'Votre message est trop court'
                                                       ])
                                         ]
                      ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
