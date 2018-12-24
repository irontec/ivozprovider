<?php
namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class FaxReceiveAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var FaxInterface
     */
    protected $fax;

    /**
     * FaxReceiveAction constructor.
     *
     * @param Wrapper $agi
     * @param EntityTools $entityTools
     */
    public function __construct(
        Wrapper $agi,
        EntityTools $entityTools
    )
    {
        $this->agi = $agi;
        $this->entityTools = $entityTools;
    }

    /**
     * @param FaxInterface|null $fax
     * @return $this
     */
    public function setFax(FaxInterface $fax = null)
    {
        $this->fax = $fax;
        return $this;
    }

    public function process()
    {
        $fax = $this->fax;

        if (is_null($fax)) {
            $this->agi->error("Fax is not properly defined. Check configuration.");
            return;
        }

        // This fax routed from DDI
        $did = $this->agi->getExtension();

        // Fax location is lbased on asterisk configuration
        $spoolDir = $this->agi->getVariable("AST_CONFIG(asterisk.conf,directories,astspooldir)");

        // Set destination file and fax options
        $faxDir = $spoolDir . "/faxes";
        if(!is_dir($faxDir)){
            mkdir($faxDir,0777);
        }

        $this->agi->setVariable("FAXFILE", $spoolDir . "/faxes/fax-" . $did . "-" . time() . ".tif");
        $this->agi->setVariable("FAXOPT(headerinfo)", $fax->getName());
        $this->agi->setVariable("FAXOPT(localstationid)", $did);

        // Create a new items for received fax data
        $faxInDto = new FaxesInOutDto();
        $faxInDto
            ->setFaxId($fax->getId())
            ->setSrc($this->agi->getVariable("CALLERID(number)"))
            ->setDst($did)
            ->setType("In")
            ->setStatus("inprogress");

        /** @var FaxesInOutInterface $faxIn */
        $faxIn = $this->entityTools->persistDto($faxInDto, null, true);

        // Store FaxId for later searchs
        $this->agi->setVariable("FAXFILE_ID", $faxIn->getId());

        // Some verbose dolan pls
        $this->agi->notice("Incoming fax for %s [fax%d])", $fax->getName(), $fax->getId());

        // Set recive fax options
        $this->agi->setVariable("FAX_OPT","zf");

        // Redirect to the calling dialplan context
        $this->agi->redirect('fax-receive', $did);
    }

}
