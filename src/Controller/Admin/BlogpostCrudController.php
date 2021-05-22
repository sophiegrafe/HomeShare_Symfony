<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Security\Core\Security;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BlogpostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blogpost::class;
    }

    //customize the form area and the board
    public function configureFields(string $pageName): iterable
    {
        //to upload the image file
        $photoFile = TextField::new(propertyName: 'photoFile')
                        ->setFormType(formTypeFqcn: VichImageType::class);                       
                        
        //to set the path for the miniarture on the Blogpost board
        $photo = ImageField::new(propertyName: 'photo')
                        ->setBasePath(path: '/uploads/blogposts');                        
        
        $fields = [
            TextField::new(propertyName: 'title'),
            TextEditorField::new(propertyName: 'content'),
            // to see the slug on the board but not in the form
            SlugField::new(propertyName: 'slug')
                ->setTargetFieldName('title')
                ->hideOnIndex(),
            DateField::new(propertyName: 'createdDate')
                ->hideOnForm(),
            AssociationField::new(propertyName: 'user')
                ->hideOnForm(),
            
            /*add a magic function in the associate entity : __toString () wich return a string, for exemples the name, title, label, etc, of this entity.*/
            AssociationField::new('city'),
        ];

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $photo;
        } else {
            $fields[] = $photoFile;
        }

        return $fields;
    }

    // sort the blogpost list
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdDate' => 'DESC']);
    }

    
}
