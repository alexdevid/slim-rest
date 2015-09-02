<?php

namespace Models\Base;

use \Exception;
use \PDO;
use Models\Code as ChildCode;
use Models\CodeQuery as ChildCodeQuery;
use Models\Map\CodeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'code' table.
 *
 *
 *
 * @method     ChildCodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCodeQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildCodeQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildCodeQuery orderByRedirectUri($order = Criteria::ASC) Order by the redirect_uri column
 * @method     ChildCodeQuery orderByScope($order = Criteria::ASC) Order by the scope column
 * @method     ChildCodeQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 *
 * @method     ChildCodeQuery groupById() Group by the id column
 * @method     ChildCodeQuery groupByCode() Group by the code column
 * @method     ChildCodeQuery groupByClientId() Group by the client_id column
 * @method     ChildCodeQuery groupByRedirectUri() Group by the redirect_uri column
 * @method     ChildCodeQuery groupByScope() Group by the scope column
 * @method     ChildCodeQuery groupByExpires() Group by the expires column
 *
 * @method     ChildCodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCodeQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method     ChildCodeQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method     ChildCodeQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method     ChildCodeQuery joinWithClient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Client relation
 *
 * @method     ChildCodeQuery leftJoinWithClient() Adds a LEFT JOIN clause and with to the query using the Client relation
 * @method     ChildCodeQuery rightJoinWithClient() Adds a RIGHT JOIN clause and with to the query using the Client relation
 * @method     ChildCodeQuery innerJoinWithClient() Adds a INNER JOIN clause and with to the query using the Client relation
 *
 * @method     \Models\ClientQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCode findOne(ConnectionInterface $con = null) Return the first ChildCode matching the query
 * @method     ChildCode findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCode matching the query, or a new ChildCode object populated from the query conditions when no match is found
 *
 * @method     ChildCode findOneById(int $id) Return the first ChildCode filtered by the id column
 * @method     ChildCode findOneByCode(string $code) Return the first ChildCode filtered by the code column
 * @method     ChildCode findOneByClientId(string $client_id) Return the first ChildCode filtered by the client_id column
 * @method     ChildCode findOneByRedirectUri(string $redirect_uri) Return the first ChildCode filtered by the redirect_uri column
 * @method     ChildCode findOneByScope(string $scope) Return the first ChildCode filtered by the scope column
 * @method     ChildCode findOneByExpires(int $expires) Return the first ChildCode filtered by the expires column *

 * @method     ChildCode requirePk($key, ConnectionInterface $con = null) Return the ChildCode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCode requireOne(ConnectionInterface $con = null) Return the first ChildCode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCode requireOneById(int $id) Return the first ChildCode filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCode requireOneByCode(string $code) Return the first ChildCode filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCode requireOneByClientId(string $client_id) Return the first ChildCode filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCode requireOneByRedirectUri(string $redirect_uri) Return the first ChildCode filtered by the redirect_uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCode requireOneByScope(string $scope) Return the first ChildCode filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCode requireOneByExpires(int $expires) Return the first ChildCode filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCode[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCode objects based on current ModelCriteria
 * @method     ChildCode[]|ObjectCollection findById(int $id) Return ChildCode objects filtered by the id column
 * @method     ChildCode[]|ObjectCollection findByCode(string $code) Return ChildCode objects filtered by the code column
 * @method     ChildCode[]|ObjectCollection findByClientId(string $client_id) Return ChildCode objects filtered by the client_id column
 * @method     ChildCode[]|ObjectCollection findByRedirectUri(string $redirect_uri) Return ChildCode objects filtered by the redirect_uri column
 * @method     ChildCode[]|ObjectCollection findByScope(string $scope) Return ChildCode objects filtered by the scope column
 * @method     ChildCode[]|ObjectCollection findByExpires(int $expires) Return ChildCode objects filtered by the expires column
 * @method     ChildCode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CodeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Base\CodeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'dev_main', $modelName = '\\Models\\Code', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCodeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCodeQuery) {
            return $criteria;
        }
        $query = new ChildCodeQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CodeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CodeTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, code, client_id, redirect_uri, scope, expires FROM code WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCode $obj */
            $obj = new ChildCode();
            $obj->hydrate($row);
            CodeTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCode|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CodeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CodeTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CodeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CodeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CodeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CodeTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClientId('fooValue');   // WHERE client_id = 'fooValue'
     * $query->filterByClientId('%fooValue%'); // WHERE client_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByClientId($clientId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clientId)) {
                $clientId = str_replace('*', '%', $clientId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CodeTableMap::COL_CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the redirect_uri column
     *
     * Example usage:
     * <code>
     * $query->filterByRedirectUri('fooValue');   // WHERE redirect_uri = 'fooValue'
     * $query->filterByRedirectUri('%fooValue%'); // WHERE redirect_uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $redirectUri The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByRedirectUri($redirectUri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($redirectUri)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $redirectUri)) {
                $redirectUri = str_replace('*', '%', $redirectUri);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CodeTableMap::COL_REDIRECT_URI, $redirectUri, $comparison);
    }

    /**
     * Filter the query on the scope column
     *
     * Example usage:
     * <code>
     * $query->filterByScope('fooValue');   // WHERE scope = 'fooValue'
     * $query->filterByScope('%fooValue%'); // WHERE scope LIKE '%fooValue%'
     * </code>
     *
     * @param     string $scope The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scope)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $scope)) {
                $scope = str_replace('*', '%', $scope);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CodeTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query on the expires column
     *
     * Example usage:
     * <code>
     * $query->filterByExpires(1234); // WHERE expires = 1234
     * $query->filterByExpires(array(12, 34)); // WHERE expires IN (12, 34)
     * $query->filterByExpires(array('min' => 12)); // WHERE expires > 12
     * </code>
     *
     * @param     mixed $expires The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function filterByExpires($expires = null, $comparison = null)
    {
        if (is_array($expires)) {
            $useMinMax = false;
            if (isset($expires['min'])) {
                $this->addUsingAlias(CodeTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(CodeTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CodeTableMap::COL_EXPIRES, $expires, $comparison);
    }

    /**
     * Filter the query by a related \Models\Client object
     *
     * @param \Models\Client|ObjectCollection $client The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCodeQuery The current query, for fluid interface
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof \Models\Client) {
            return $this
                ->addUsingAlias(CodeTableMap::COL_CLIENT_ID, $client->getClientId(), $comparison);
        } elseif ($client instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CodeTableMap::COL_CLIENT_ID, $client->toKeyValue('PrimaryKey', 'ClientId'), $comparison);
        } else {
            throw new PropelException('filterByClient() only accepts arguments of type \Models\Client or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Client relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Client');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Client');
        }

        return $this;
    }

    /**
     * Use the Client relation Client object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\ClientQuery A secondary query class using the current class as primary query
     */
    public function useClientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\Models\ClientQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCode $code Object to remove from the list of results
     *
     * @return $this|ChildCodeQuery The current query, for fluid interface
     */
    public function prune($code = null)
    {
        if ($code) {
            $this->addUsingAlias(CodeTableMap::COL_ID, $code->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the code table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CodeTableMap::clearInstancePool();
            CodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CodeQuery
