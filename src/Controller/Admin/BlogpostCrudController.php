<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogpostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blogpost::class;
    }

    //customize the form area and the board
    public function configureFields(string $pageName): iterable
    {
        // return [
        //     Field::new('title'),
        //     // to see the slug on the board but not in the form
        //     Field::new('slug')->hideOnForm(),
        //     Field::new('content'),
        //     Field::new('createdDate')->hideOnForm(),

        //     //this one is problematic, need some time to read the doc and figure it out
        //     Field::new('city'),
        // ];
        return [
            TextField::new('title'),
            // to see the slug on the board but not in the form
            TextField::new('slug')->hideOnForm(),            
            TextareaField::new('content'),
            DateField::new('createdDate')->hideOnForm(),

            // this one is problematic, need some time to read the doc and figure it out
            // need to set the city in crud but need a prior traitement to allow a string in 'create new blogpost' then persiste the id attach to the string in City table.
            AssociationField::new('city')->hideOnForm(),
        ];
    }

    // sort the blogpost list
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdDate' => 'DESC']);
    }

    
}
