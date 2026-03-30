<?php

namespace App\Form;

use App\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'required' => false,
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('results', TextType::class, [
                'label' => 'Résultats',
                'required' => false,
            ])
            ->add('learnings', TextType::class, [
                'label' => 'Compétences acquises',
                'required' => false,
            ])
            ->add('thumbnailFile', FileType::class, [
                'label' => 'Image',
                'required' => false,
            ])
            ->add('github_url', TextType::class, [
                'label' => 'GitHub URL',
                'required' => false,
            ])
            ->add('demo_url', TextType::class, [
                'label' => 'Demo URL',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
            ])
             ->addEventListener(FormEvents::PRE_SUBMIT, $this->listenerFactory->autoSlug('title'))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->listenerFactory->timestamp());
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ]);
    }
}
