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
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogpostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blogpost::class;
    }

    //customize the form area and the board
    public function configureFields(string $pageName): iterable
    {
        
        return [
            TextField::new('title'),
            // to see the slug on the board but not in the form
            TextareaField::new('content'),
            TextField::new('photoFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
            //this field set the miniarture on the Blogpost board
            ImageField::new('photo')->setBasePath('/uploads/blogposts/')->onlyOnIndex(),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),            
            DateField::new('createdDate')->hideOnForm(),
            AssociationField::new('user')->hideOnForm(),

            /* this one is problematic, need to set the city in crud but need a prior traitement to allow a string in 'create new blogpost' then persiste the id attach to the string in City table.
            --> SOLUTION !!! --> add a magic function in the associate entity __toString () wich return a string, for exemples the name, title, label, etc, of this entity.  
            */
            AssociationField::new('city'),
        ];
    }

    // sort the blogpost list
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdDate' => 'DESC']);
    }

    
}
