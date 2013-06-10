<?php
/**
 * Date: 10/06/13
 * Time: 13:24
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

/*
 * remaplcer BasketState
 * remplacer AdminBundle
 * remplacer basket_state_form
 */

namespace Site\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BasketStateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\AdminBundle\Entity\BasketState'
        ));
    }


    public function getName()
    {
        return "basket_state_form";
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view["name"]->vars["label"] = "Nom";

    }
}
