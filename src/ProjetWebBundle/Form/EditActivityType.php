<?php
/**
 * Created by IntelliJ IDEA.
 * User: rfezr
 * Date: 19/04/2017
 * Time: 23:12
 */

namespace ProjetWebBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class EditActivityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activityName'
                , null,["error_bubbling" => true, "label" => "Nom de l'activité"]
            )
            ->add('date', null,["error_bubbling" => true,
                "label" => "Date de l'évenement"])
            ->add('description'
                , null,["error_bubbling" => true, "label" => "Description de l'activité"]
            )
            ->add('state', ChoiceType::class, array(
                'choices' => array(
                    'EN ATTENTE' =>1 ,
                    'VALIDE' => 2,
                    'REFUSE'=> 3,
                ),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                'data' => 'FACTURE',
                "label" => "Type de document"
            ))


            ->add('price', MoneyType::class, array( "error_bubbling" => true,"label" => "PRIX"));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjetWebBundle\Entity\Activity'
        ));
    }

}