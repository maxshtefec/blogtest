<?php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => 'Titulo',
                'translation_domain' => 'BloggerBlogBundle',
                'attr' => array(
                    'placeholder' => 'blog.blog.new.form.placeholder_titulo',
                    'class' => 'form-control',
                ),
            ))
            ->add('content', null, array(
                'label' => 'Contenido',
                'translation_domain' => 'BloggerBlogBundle', //indicando archivo de traducción...
                'attr' => array(
                    'placeholder' => 'blog.blog.new.form.placeholder_contenido', //aplicando traducción...
                    'class' => 'form-control',
                    'rows' => '6',
                ),
            ))
            ->add('documents', 'collection', array(
                'label' => false,
                'type' => new DocumentType(),
                'required' => false,
            ))
            ->getForm()
        ;

        //esta es una forma de dar estilo al form, se lo puede hacer desde aca o desde la vista usando twig....
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blogger\BlogBundle\Entity\Blog',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogger_blogbundle_blog';
    }
}
