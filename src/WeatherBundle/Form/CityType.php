<?php

namespace WeatherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use WeatherBundle\Repository\DataSourceRepository;

class CityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('population')
            ->add('longitude')
            ->add('latitude')
            ->add('dataSource') //WHERE lat BETWEEN lat1 AND lat 2 AND lng BETWEEN lng1 AND lng2
            ->add('dataSource', EntityType::class, array(
                'class' => 'WeatherBundle:dataSource',
                'query_builder' => function (DataSourceRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->findBetweenLatLng();
                        //->orderBy('d.name', 'ASC');
                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WeatherBundle\Entity\City'
        ));
    }
}
