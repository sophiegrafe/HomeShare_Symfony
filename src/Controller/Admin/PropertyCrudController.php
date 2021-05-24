<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Property;
use App\Form\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureFields(string $pageName): iterable
    {        
        $fields = [
            TextField::new('title'),
            TextEditorField::new('shortDescription'),
            TextEditorField::new('longDescription'),
            NumberField::new('capacity'),
            NumberField::new('nbBathroom'),
            NumberField::new('nbWc'),
            BooleanField::new('isEnable'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
            TextField::new('photoFile')->setFormType(VichImageType::class)->onlyWhenCreating(),
            //this field set the miniarture on the Properties board
            ImageField::new('photo')->setBasePath('/uploads/properties/')->onlyOnIndex(),
            DateField::new('createdDate')->hideOnForm(),
            AssociationField::new('owner')->hideOnForm(),
            TextField::new('number')->setFormType(AddressType::class)->onlyWhenCreating(),
            TextField::new('street')->setFormType(AddressType::class)->onlyWhenCreating(),
            TextField::new('zipcode')->setFormType(AddressType::class)->onlyWhenCreating(),
            AssociationField::new('country'),
            AssociationField::new('city'),
            AssociationField::new('address'),            
        ];
        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdDate' => 'DESC']);
    }
}
