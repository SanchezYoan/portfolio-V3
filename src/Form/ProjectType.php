<?php

namespace App\Form;

use App\Entity\Projects;
use App\Enum\CategoryEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Service\FormListenerFactory;

class ProjectType extends AbstractType
{
    public function __construct(private FormListenerFactory $listenerFactory)
    {
    }
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
            ->add('description', TextareaType::class, [
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
            ->add('category', EnumType::class, [
                'class'   => CategoryEnum::class,
                'label'   => 'Catégorie',
                'choice_label' => fn(CategoryEnum $c) => $c->label(),
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
