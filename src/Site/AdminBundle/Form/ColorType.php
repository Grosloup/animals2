<?php

namespace Site\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('foreground')
            ->add('background')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\AdminBundle\Entity\Color'
        ));
    }

    public function getName()
    {
        return 'site_adminbundle_colortype';
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view["name"]->vars["label"] = "Nom";
        $view["foreground"]->vars["label"] = "Couleur du texte";
        $view["background"]->vars["label"] = "Couleur du fond";

    }
}
