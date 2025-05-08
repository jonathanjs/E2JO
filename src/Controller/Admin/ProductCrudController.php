<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceValue;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
            // ...
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom')->setHelp('Nom de la video'),
            SlugField::new('slug')->setTargetFieldName('name')->setlabel('URL')->setHelp('URL de votre video'),
            TextEditorField::new('description')->setlabel('Description')->setHelp('Description de votre video'),
            ImageField::new('image')->setLabel('Image')->setHelp('Envoyer votre image 600*600px')->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')->setBasePath('/uploads/videoCours')->setUploadDir('/public/uploads/videoCours'),
            NumberField::new('price')->setLabel('Prix H.T')->setHelp('Prix H.T de la video en ligne'),
            ChoiceField::new('Tva')->setLabel('Taux de TVA')->setChoices([
                '5,5%'=>'5.5',
                '10%'=>'10',
                '20%'=>'20'

            ]),
            AssociationField::new('category','Categorie associée')
 
        ];
    }

}
