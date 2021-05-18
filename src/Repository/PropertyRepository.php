<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Property;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{   
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Property::class);
        $this->paginator = $paginator;
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    
    public function getLastTen()
    {
        return $this->createQueryBuilder('p')         
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(10)            
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Property[] Returns an array of Property objects
     */

    public function getSearchResult(SearchData $data)
    {
        $isEnable = true;
        $query = $this->createQueryBuilder('p')
            ->select(                
                'p.isEnable',
                'p.photo',
                'p.title',
                'p.capacity',                
                'city.cityName',               
                'country.countryName',            
            )
                        
            ->join('p.city', 'city')              
            ->join('p.country', 'country');

        if(!empty($data->country)){
            $query =$query->andWhere('p.country = :country')            
            ->setParameter('country', $data->country);
        }

        if (!empty($data->city)) {
            $query = $query->andWhere('p.city = :city')
            ->setParameter('city', $data->city);
        }

        $query = $query->andWhere('p.isEnable = :isEnable')
        ->setParameter('isEnable', $isEnable);
                
        $result =  $query->getQuery();
        // pourquoi pas $result =  $query->getResult();

        return $this->paginator->paginate(
            $result,
            $data->numeroPage,
            12 // objet $data dans le controller, propriété publique dans la classe            
        );
    }


    

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
