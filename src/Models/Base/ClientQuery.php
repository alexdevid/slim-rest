<?php

namespace Models\Base;

use \Exception;
use \PDO;
use Models\Client as ChildClient;
use Models\ClientQuery as ChildClientQuery;
use Models\Map\ClientTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'client' table.
 *
 *
 *
 * @method     ChildClientQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildClientQuery orderByClientId($order = Criteria::ASC) Order by the client_id column
 * @method     ChildClientQuery orderByClientSecret($order = Criteria::ASC) Order by the client_secret column
 * @method     ChildClientQuery orderByGrantTypes($order = Criteria::ASC) Order by the grant_types column
 * @method     ChildClientQuery orderByRedirectUri($order = Criteria::ASC) Order by the redirect_uri column
 * @method     ChildClientQuery orderByScope($order = Criteria::ASC) Order by the scope column
 *
 * @method     ChildClientQuery groupById() Group by the id column
 * @method     ChildClientQuery groupByClientId() Group by the client_id column
 * @method     ChildClientQuery groupByClientSecret() Group by the client_secret column
 * @method     ChildClientQuery groupByGrantTypes() Group by the grant_types column
 * @method     ChildClientQuery groupByRedirectUri() Group by the redirect_uri column
 * @method     ChildClientQuery groupByScope() Group by the scope column
 *
 * @method     ChildClientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClientQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClientQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClientQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClientQuery leftJoinToken($relationAlias = null) Adds a LEFT JOIN clause to the query using the Token relation
 * @method     ChildClientQuery rightJoinToken($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Token relation
 * @method     ChildClientQuery innerJoinToken($relationAlias = null) Adds a INNER JOIN clause to the query using the Token relation
 *
 * @method     ChildClientQuery joinWithToken($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Token relation
 *
 * @method     ChildClientQuery leftJoinWithToken() Adds a LEFT JOIN clause and with to the query using the Token relation
 * @method     ChildClientQuery rightJoinWithToken() Adds a RIGHT JOIN clause and with to the query using the Token relation
 * @method     ChildClientQuery innerJoinWithToken() Adds a INNER JOIN clause and with to the query using the Token relation
 *
 * @method     ChildClientQuery leftJoinCode($relationAlias = null) Adds a LEFT JOIN clause to the query using the Code relation
 * @method     ChildClientQuery rightJoinCode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Code relation
 * @method     ChildClientQuery innerJoinCode($relationAlias = null) Adds a INNER JOIN clause to the query using the Code relation
 *
 * @method     ChildClientQuery joinWithCode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Code relation
 *
 * @method     ChildClientQuery leftJoinWithCode() Adds a LEFT JOIN clause and with to the query using the Code relation
 * @method     ChildClientQuery rightJoinWithCode() Adds a RIGHT JOIN clause and with to the query using the Code relation
 * @method     ChildClientQuery innerJoinWithCode() Adds a INNER JOIN clause and with to the query using the Code relation
 *
 * @method     \Models\TokenQuery|\Models\CodeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildClient findOne(ConnectionInterface $con = null) Return the first ChildClient matching the query
 * @method     ChildClient findOneOrCreate(ConnectionInterface $con = null) Return the first ChildClient matching the query, or a new ChildClient object populated from the query conditions when no match is found
 *
 * @method     ChildClient findOneById(int $id) Return the first ChildClient filtered by the id column
 * @method     ChildClient findOneByClientId(string $client_id) Return the first ChildClient filtered by the client_id column
 * @method     ChildClient findOneByClientSecret(string $client_secret) Return the first ChildClient filtered by the client_secret column
 * @method     ChildClient findOneByGrantTypes(string $grant_types) Return the first ChildClient filtered by the grant_types column
 * @method     ChildClient findOneByRedirectUri(string $redirect_uri) Return the first ChildClient filtered by the redirect_uri column
 * @method     ChildClient findOneByScope(string $scope) Return the first ChildClient filtered by the scope column *

 * @method     ChildClient requirePk($key, ConnectionInterface $con = null) Return the ChildClient by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOne(ConnectionInterface $con = null) Return the first ChildClient matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClient requireOneById(int $id) Return the first ChildClient filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByClientId(string $client_id) Return the first ChildClient filtered by the client_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByClientSecret(string $client_secret) Return the first ChildClient filtered by the client_secret column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByGrantTypes(string $grant_types) Return the first ChildClient filtered by the grant_types column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByRedirectUri(string $redirect_uri) Return the first ChildClient filtered by the redirect_uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByScope(string $scope) Return the first ChildClient filtered by the scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClient[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildClient objects based on current ModelCriteria
 * @method     ChildClient[]|ObjectCollection findById(int $id) Return ChildClient objects filtered by the id column
 * @method     ChildClient[]|ObjectCollection findByClientId(string $client_id) Return ChildClient objects filtered by the client_id column
 * @method     ChildClient[]|ObjectCollection findByClientSecret(string $client_secret) Return ChildClient objects filtered by the client_secret column
 * @method     ChildClient[]|ObjectCollection findByGrantTypes(string $grant_types) Return ChildClient objects filtered by the grant_types column
 * @method     ChildClient[]|ObjectCollection findByRedirectUri(string $redirect_uri) Return ChildClient objects filtered by the redirect_uri column
 * @method     ChildClient[]|ObjectCollection findByScope(string $scope) Return ChildClient objects filtered by the scope column
 * @method     ChildClient[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ClientQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Base\ClientQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'dev_main', $modelName = '\\Models\\Client', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClientQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildClientQuery) {
            return $criteria;
        }
        $query = new ChildClientQuery();
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
     * @return ChildClient|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ClientTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClientTableMap::DATABASE_NAME);
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
     * @return ChildClient A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, client_id, client_secret, grant_types, redirect_uri, scope FROM client WHERE id = :p0';
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
            /** @var ChildClient $obj */
            $obj = new ChildClient();
            $obj->hydrate($row);
            ClientTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildClient|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClientTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClientTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ClientTableMap::COL_CLIENT_ID, $clientId, $comparison);
    }

    /**
     * Filter the query on the client_secret column
     *
     * Example usage:
     * <code>
     * $query->filterByClientSecret('fooValue');   // WHERE client_secret = 'fooValue'
     * $query->filterByClientSecret('%fooValue%'); // WHERE client_secret LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientSecret The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByClientSecret($clientSecret = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientSecret)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clientSecret)) {
                $clientSecret = str_replace('*', '%', $clientSecret);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_CLIENT_SECRET, $clientSecret, $comparison);
    }

    /**
     * Filter the query on the grant_types column
     *
     * Example usage:
     * <code>
     * $query->filterByGrantTypes('fooValue');   // WHERE grant_types = 'fooValue'
     * $query->filterByGrantTypes('%fooValue%'); // WHERE grant_types LIKE '%fooValue%'
     * </code>
     *
     * @param     string $grantTypes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByGrantTypes($grantTypes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grantTypes)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $grantTypes)) {
                $grantTypes = str_replace('*', '%', $grantTypes);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_GRANT_TYPES, $grantTypes, $comparison);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ClientTableMap::COL_REDIRECT_URI, $redirectUri, $comparison);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ClientTableMap::COL_SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query by a related \Models\Token object
     *
     * @param \Models\Token|ObjectCollection $token the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByToken($token, $comparison = null)
    {
        if ($token instanceof \Models\Token) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_CLIENT_ID, $token->getClientId(), $comparison);
        } elseif ($token instanceof ObjectCollection) {
            return $this
                ->useTokenQuery()
                ->filterByPrimaryKeys($token->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByToken() only accepts arguments of type \Models\Token or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Token relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function joinToken($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Token');

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
            $this->addJoinObject($join, 'Token');
        }

        return $this;
    }

    /**
     * Use the Token relation Token object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\TokenQuery A secondary query class using the current class as primary query
     */
    public function useTokenQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinToken($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Token', '\Models\TokenQuery');
    }

    /**
     * Filter the query by a related \Models\Code object
     *
     * @param \Models\Code|ObjectCollection $code the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByCode($code, $comparison = null)
    {
        if ($code instanceof \Models\Code) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_CLIENT_ID, $code->getClientId(), $comparison);
        } elseif ($code instanceof ObjectCollection) {
            return $this
                ->useCodeQuery()
                ->filterByPrimaryKeys($code->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCode() only accepts arguments of type \Models\Code or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Code relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function joinCode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Code');

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
            $this->addJoinObject($join, 'Code');
        }

        return $this;
    }

    /**
     * Use the Code relation Code object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\CodeQuery A secondary query class using the current class as primary query
     */
    public function useCodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Code', '\Models\CodeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildClient $client Object to remove from the list of results
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function prune($client = null)
    {
        if ($client) {
            $this->addUsingAlias(ClientTableMap::COL_ID, $client->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the client table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClientTableMap::clearInstancePool();
            ClientTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClientTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ClientTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ClientTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ClientQuery
