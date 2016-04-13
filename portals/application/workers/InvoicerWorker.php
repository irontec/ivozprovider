<?php


use IvozProvider\Mapper\Sql\MusicOnHold;

class InvoicerWorker extends Iron_Gearman_Worker
{
    protected $_timeout = 10000; // 1000 = 1 second
    protected $_mapper;

    protected function initRegisterFunctions()
    {

        $this->_registerFunction = array(
                'invoice' => 'invoice'
        );
    }

    protected function init()
    {
        $this->_mapper = new MusicOnHold();

    }

    protected function timeout()
    {
        $this->_mapper->getDbTable()->getAdapter()->closeConnection();
    }

    public function invoice(\GearmanJob $serializedJob)
    {

        $job = igbinary_unserialize($serializedJob->workload());
        $pk = $job->getPk();
        $this->_logger->log("[INVOICER] ID = ".$pk, \Zend_Log::INFO);
        $invoicesMapper = new \IvozProvider\Mapper\Sql\Invoices();

        $unsetInvoiceIdQuery = "UPDATE parsedCDRs set invoiceId = null WHERE invoiceId = '".$pk."'";
        $dbAdapter = $invoicesMapper->getDbTable()->getAdapter();
        $dbAdapter->query($unsetInvoiceIdQuery);

        $invoice = $invoicesMapper->find($pk);
        $invoice->setStatus("processing")->save();
        $this->_logger->log("[INVOICER] Status = processing", \Zend_Log::INFO);
        try {
            $invoiceGenerator = new \IvozProvider\Gearmand\Invoices\Generator($pk, $this->_logger);
            $content = $invoiceGenerator->getInvoicePDFContents();
            $tempPath = APPLICATION_PATH."/../storage/invoice";
            if (!file_exists($tempPath)) {
                mkdir($tempPath);
            }
            $tempPdf = $tempPath."/temp.pdf";
            file_put_contents($tempPdf, $content);
            $invoice->putPdfFile($tempPdf, "invoice.pdf");
            $totals = $invoiceGenerator->getTotals();
            $invoice
                ->setTotal($totals["totalPrice"])
                ->setTotalWithTax($totals["totalWithTaxes"])
                ->setStatus("created")
                ->save();
            $this->_logger->log("[INVOICER] Status = created", \Zend_Log::INFO);
        } catch (Exception $e) {
            $invoice
                ->setStatus("error")
                ->save();
            $this->_logger->log("[INVOICER] Status = error", \Zend_Log::INFO);
            $this->_logger->log("[INVOICER] Error was: ".$e->getMessage(), \Zend_Log::INFO);
        }

        return true;
    }

}
