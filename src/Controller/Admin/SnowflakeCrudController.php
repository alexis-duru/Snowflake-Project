<?php

namespace App\Controller\Admin;

use App\Entity\Snowflake;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class SnowflakeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Snowflake::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Snowflakes')
            ->setEntityLabelInSingular('Cornflake')
            ->setSearchFields(['name', 'luckyNumber', 'id'])
            ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }

    // public function configureFilters(Filters $filters): Filters
    // {
    //     // return $filters
    //     //     ->add(EntityFilter::new('luckyNumber');
    // }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield IntegerField::new('luckyNumber');
        yield TextEditorField::new('description')->hideOnIndex();

        $createdAt = DateTimeField::new('createdAt')->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ]);

        if (Crud::PAGE_EDIT === $pageName) {
            yield $createdAt->setFormTypeOption('disabled', true);
        } else {
            yield $createdAt;
        }
    }
}
