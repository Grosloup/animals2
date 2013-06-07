<?php
/**
 * Date: 08/06/13
 * Time: 00:04
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("username")
                ->add("plainPassword","text",["required"=>true])
                ->add("reelFirstname")
                ->add("reelLastname")
                ->add("firstname")
                ->add("lastname")
                ->add("email")
                //->add("isActive")
        ;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view["username"]->vars["label"] = "Pseudo";
        $view["plainPassword"]->vars["label"] = "Mot de passe";
        $view["reelFirstname"]->vars["label"] = "Prénom réel";
        $view["reelLastname"]->vars["label"] = "Nom réel";
        $view["firstname"]->vars["label"] = "Prénom modifiable";
        $view["lastname"]->vars["label"] = "Nom modifiable";
        $view["email"]->vars["label"] = "Adresse mail";

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\AdminBundle\Entity\User'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "user_register_form";
    }
}
