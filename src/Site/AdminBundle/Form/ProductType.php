<?php
/**
 * Date: 10/06/13
 * Time: 13:24
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */


namespace Site\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')->add('reference')->add('type')->add('packaging')->add('weight')->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\AdminBundle\Entity\Product'
        ));
    }


    public function getName()
    {
        return "product_form";
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view["name"]->vars["label"] = "Nom";
        $view["reference"]->vars["label"] = "Référence";
        $view["type"]->vars["label"] = "Catégorie";
        $view["packaging"]->vars["label"] = "Conditionnement";
        $view["weight"]->vars["label"] = "Poids (kg/unité)";
        $view["description"]->vars["label"] = "Description";




    }
}
