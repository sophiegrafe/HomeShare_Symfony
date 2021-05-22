<?php

namespace App\Controller\Admin;

use App\Entity\Property;
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
        return [
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
            AssociationField::new('address'),
            AssociationField::new('owner')->hideOnForm(),
            // New type of field available with easyadmin v3, but does not work yet --> need bugfix 
            // ImageField::new('photo')->setBasePath('/uploads/properties/')->setUploadDir('public/uploads/properties/')->setFormType(FileUploadType::class),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdDate' => 'DESC']);
    }
}
