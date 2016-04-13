<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\Invoices
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class Invoices extends Raw\Invoices
{

    protected function _save(\IvozProvider\Model\Raw\Invoices $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {

        $createPdf = false;
        if (is_null($model->getPrimaryKey())) {
//             $model->setStatus("waiting");
            $createPdf = true;
        }
        $error = $this->_checkErrors($model);
        if ($error !== false) {
            $createPdf = false;
            $model->setStatus("error");
        }

        $hasChangedInDate = $model->hasChange("inDate");
        $hasChangedOutDate = $model->hasChange("outDate");
        $hasChangedTaxRate = $model->hasChange("taxRate");
        $hasChangedTemplate = $model->hasChange("invoiceTemplateId");
        $hasChanged = $hasChangedInDate || $hasChangedOutDate || $hasChangedTaxRate || $hasChangedTemplate;

        if ($hasChanged && $error === false) {
            $createPdf = true;
            $model->setStatus("waiting");
        }
        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        if ($error !== false) {
            $createPdf = false;
            throw new \Exception("", $error);
        }
        if ($createPdf) {
            $invoicerJob = new \IvozProvider\Gearmand\Jobs\Invoicer();
            $invoicerJob->setPk($pk)->send();
        }
        return $pk;
    }

    protected function _checkErrors(\IvozProvider\Model\Raw\Invoices $invoice)
    {

        $invoiceTz = $invoice->getCompany()->getDefaultTimezone()->getTz();
        $inDate = $invoice->getInDate(true);
        $inDate->setTimezone($invoiceTz);
        $outDate = $invoice->getOutDate(true);
        $outDate->setTimezone($invoiceTz);
        $outDate->addDay(1)->subSecond(1);

        if ($inDate->compare($outDate) >= 0) {
            return 50005;
        }

        $now = new \Zend_Date();
        $now->setTimezone($invoiceTz);
        $inDateIsInFuture = $invoice->getInDate(true)->getDate()->compare($now->getDate()) >= 0;
        $outDateIsInFuture = $invoice->getOutDate(true)->getDate()->compare($now->getDate()) >= 0;
        if ($inDateIsInFuture || $outDateIsInFuture) {
            return 50006;
        }

        $callMapper = new \IvozProvider\Mapper\Sql\ParsedCDRs();

        $wheres = array(
                "companyId = '".$invoice->getCompanyId()."'",
                "brandId = '".$invoice->getBrandId()."'",
                "calldate <= '".$outDate->toString('yyyy-MM-dd HH:mm:ss')."'",
                "metered = 0"
        );
        $untarificattedCalls = $callMapper->fetchTarificableList($wheres);
        if (!empty($untarificattedCalls)) {
            return 50001;
        }

        $wheres = array(
                "companyId = '".$invoice->getCompanyId()."'",
                "brandId = '".$invoice->getBrandId()."'",
                "calldate < '".$inDate->toString('yyyy-MM-dd HH:mm:ss')."'",
                "(invoiceId is null OR invoiceId = '".$invoice->getPrimaryKey()."')"
        );
        $unbilledCalls = $callMapper->fetchTarificableList($wheres);
        if (!empty($unbilledCalls)) {
            return 50002;
        }

        $wheres = array(
                "companyId = '".$invoice->getCompanyId()."'",
                "brandId = '".$invoice->getBrandId()."'",
                "outDate > '".$outDate->setTimezone("UTC")->toString('yyyy-MM-dd HH:mm:ss')."'",
                "id != '".$invoice->getPrimaryKey()."'"
        );
        $invoices = $this->fetchList(implode(" AND ", $wheres), "inDate asc");
        if (!empty($invoices)) {
            $nextInvoiceInDate = $invoices[0]->getInDate(true);
            $wheres = array(
                    "companyId = '".$invoice->getCompanyId()."'",
                    "brandId = '".$invoice->getBrandId()."'",
                    "calldate > '".$outDate->setTimezone($invoiceTz)->toString('yyyy-MM-dd HH:mm:ss')."'",
                    "calldate < '".$nextInvoiceInDate->setTimezone($invoiceTz)->toString('yyyy-MM-dd HH:mm:ss')."'"
            );
            $calls = $callMapper->fetchTarificableList($wheres);
            if (!empty($calls)) {
                return 50004;
            }
        }

        $wheres = array(
                "companyId = '".$invoice->getCompanyId()."'",
                "brandId = '".$invoice->getBrandId()."'",
                "inDate >= '".$inDate->setTimezone("UTC")->toString('yyyy-MM-dd HH:mm:ss')."'",
                "outDate <= '".$outDate->setTimezone("UTC")->toString('yyyy-MM-dd HH:mm:ss')."'",
                "id != '".$invoice->getPrimaryKey()."'"
        );
        $invoices = $this->fetchList(implode(" AND ", $wheres));
        if (!empty($invoices)) {
            return 50003;
        }

        return false;
    }
}
