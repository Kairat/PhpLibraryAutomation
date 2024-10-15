<?php

error_reporting(E_ALL);

require_once "Nerpa.php";

/**
 * Search expression builder.
 */
final class TermExtractor
{
    /**
     * Connection.
     */
    private $_connection;

    /**
     * FST lines.
     */
    private $_lines;

    /**
     * TermExtractor constructor.
     * @param Nerpa\Connection $_connection
     */
    public function __construct(Nerpa\Connection $_connection)
    {
        $this->_connection = $_connection;

        // TODO read the FST
    } // function ExtractTerms

    /**
     * Extract terms from the record.
     * @param Nerpa\MarcRecord $record
     * @return array
     */
    public function ExtractTerms(Nerpa\MarcRecord $record)
    {
        $result = array();
        return $result;
    } // function ExtractTerms

} // class TermExtractor
