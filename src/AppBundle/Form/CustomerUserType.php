<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CustomerUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $notBlank = "Veuillez remplir le champ";
        $minMess =  "Votre pseudo doit être de moins de { limit } caractères";
        $maxMess =  'Votre pseudo doit être de { limit } caractères maximum';

        $builder->add('username',TextType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>$notBlank]) ,
                    new Length(['min'=>4,
                                'max'=>100,
                                'minMessage'=>$minMess,
                                'maxMessage'=>$maxMess
                              ])
                            ]
                    ])

                ->add('firstname',TextType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>$notBlank]),
                    new Length(['min'=>4,
                                'max'=>100,
                                'minMessage'=>$minMess,
                                'maxMessage'=>$maxMess
                              ])
                            ]
                    ])

                ->add('lastname',TextType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>$notBlank]),
                    new Length(['min'=>4,
                                'max'=>100,
                                'minMessage'=>$minMess,
                                'maxMessage'=>$maxMess
                              ])
                            ]
                    ])

                ->add('email', EmailType::class,[
                'constraints'=>[
                    new NotBlank(['message'=>$notBlank]),
                    new Email([
                                  'message'=>'Votre email n\'est pas valide',
                                  'checkHost'=>true,
                                  'checkMX'=>true
                              ])
                            ]
                    ])

                ->add('phonenumber')
                ->add('avatar')
                ->add('password');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\customerUser'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_customeruser';
    }


}
