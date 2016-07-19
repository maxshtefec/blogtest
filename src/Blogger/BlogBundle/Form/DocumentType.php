<?php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Repository\DocumentRepository")
 * @ORM\Table(name="document")
 */
class DocumentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Nombre',
                'translation_domain' => 'BloggerBlogBundle',
                'attr' => array(
                    'placeholder' => 'Nombre de Imagen',
                    'class' => 'form-control',
                ),
            ))
            ->add('file', null, array(
                'label' => 'Subir Imagen....',
                'translation_domain' => 'BloggerBlogBundle',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blogger\BlogBundle\Entity\Document',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogger_blogbundle_document';
    }
}
