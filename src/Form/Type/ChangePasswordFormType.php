<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('plainPassword', PasswordType::class, [
'label' => 'New password',
'mapped' => false,
'constraints' => [
new NotBlank([
'message' => 'Please enter a password',
]),
new Length([
'min' => 6,
'minMessage' => 'Your password should be at least {{ limit }} characters',
'max' => 4096,
]),
],
]);
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([]);
}
}
