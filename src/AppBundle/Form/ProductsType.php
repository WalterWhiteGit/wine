<?php

namespace AppBundle\Form;

use AppBundle\AppBundle;
use AppBundle\Entity\Winetype;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('productCode')
                ->add('productName')
                ->add('productCountry')
                ->add('productImage', FileType::class,[

                    'constraints'=>
                        [

                        new NotBlank(['message'=>'Le champ est vide']),
                        new Image(['maxSize'=>'5000K',
                                   'maxSizeMessage'=>'La taille de votre image ne doit pas dépasser
                                   {{ limit }} '
                                  ]),
                        'data_class'=> null
                        ]

                ])




                ->add('productVendor')
                ->add('productDescription')
                ->add('quantityInStock')
                ->add('buyPrice')
                ->add('salePrice')
                ->add('year')
                ->add('winetype',EntityType::class,

                    ['class'=>'AppBundle\Entity\Winetype',
                     'choice_label'=>'type'
                        ])
                ->add('winearea',EntityType::class,['class'=>'AppBundle\Entity\WineArea',
                           'choice_label'=>'area'

                        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Products'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_products';
    }


}
