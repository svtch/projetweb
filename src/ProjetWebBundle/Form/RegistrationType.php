<?php
// src/ProjetWebBundle/Form/RegistrationType.php

namespace ProjetWebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('phonenumber');


    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'projetweb_user_registration';
    }
}