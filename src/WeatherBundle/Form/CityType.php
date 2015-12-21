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
        $longitude = $options['data']->getLongitude() ? $options['data']->getLongitude() : 0;
        $latitude = $options['data']->getLatitude() ? $options['data']->getLatitude() : 0;

        $builder
            ->add('name')
            ->add('population')
            ->add('longitude')
            ->add('latitude');


        if(!empty($options['data']->getLongitude()) and !empty($options['data']->getLatitude()))
            $builder
            ->add('dataSource', EntityType::class, array(
                'label' => 'Источник данных',
                'class' => 'WeatherBundle:DataSource',
                'query_builder' => function (DataSourceRepository $er) use ($longitude, $latitude) {
                    return $ds = $er->createQueryBuilder('ds')
                        ->where(" SQRT((($longitude - ds.longitude)*($longitude - ds.longitude))
                         +
                          (($latitude - ds.latitude)*($latitude - ds.latitude))) <= 10")
                            ->orderBy(' ds.name', 'ASC');
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
