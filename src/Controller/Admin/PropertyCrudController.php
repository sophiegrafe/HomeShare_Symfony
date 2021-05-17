<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
        return [
            TextField::new('title'),            
            TextareaField::new('shortDescription'),
            TextareaField::new('longDescription'),
            NumberField::new('capacity'),
            NumberField::new('nbBathroom'),
            NumberField::new('nbWc'),
            BooleanField::new('isEnable'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),            
            ImageField::new('photo')->setBasePath('/uploads/properties/')->setUploadDir('public/uploads/properties/')->setFormType(FileUploadType::class),
            DateField::new('createdDate')->hideOnForm(), 
            AssociationField::new('address'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdDate' => 'DESC']);
    }
}
