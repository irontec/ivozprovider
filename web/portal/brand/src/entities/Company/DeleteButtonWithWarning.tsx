import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import EntityService from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useCompanyDdis } from 'entities/CallCsvScheduler/hook/useCompanyDdis';
import { useEffect, useRef, useState } from 'react';

import { ClientTypes } from './ClientFeatures';

interface DeleteButtonWithWarningProps {
  row: Record<string, unknown>;
  entityService: EntityService;
}

const DeleteButtonWithWarning = ({
  row,
  entityService,
}: DeleteButtonWithWarningProps) => {
  const companyId = row.id as number | string | null;
  const companyType = row.type as string | undefined;
  const isWholesale = companyType === ClientTypes.wholesale;
  const ddis = useCompanyDdis(companyId);
  const ddisCount = ddis !== null ? Object.keys(ddis).length : 0;
  const hasDdis = ddisCount > 0;
  const shouldShowWarning = !isWholesale && hasDdis;

  const [showWarning, setShowWarning] = useState(false);
  const [proceedToDelete, setProceedToDelete] = useState(false);
  const deleteButtonRef = useRef<HTMLDivElement>(null);

  const handleWarningAccept = () => {
    setShowWarning(false);
    setProceedToDelete(true);
  };

  useEffect(() => {
    if (proceedToDelete && deleteButtonRef.current) {
      deleteButtonRef.current.querySelector('button')?.click();
    }
  }, [proceedToDelete]);

  if (!shouldShowWarning) {
    return (
      <>
        <button
          onClick={(e) => {
            e.preventDefault();
            e.stopPropagation();
            setProceedToDelete(true);
          }}
          style={{
            background: 'none',
            border: 'none',
            cursor: 'pointer',
            color: 'inherit',
            fontSize: 'inherit',
            fontFamily: 'inherit',
            padding: '4px 16px',
            textAlign: 'left',
          }}
          type='button'
        >
          {_('Delete')}
        </button>
        {proceedToDelete && (
          <div ref={deleteButtonRef} style={{ display: 'none' }}>
            <DeleteRowButton row={row} entityService={entityService} />
          </div>
        )}
      </>
    );
  }

  return (
    <>
      <button
        onClick={(e) => {
          e.preventDefault();
          e.stopPropagation();
          if (!proceedToDelete) {
            setShowWarning(true);
          }
        }}
        style={{
          background: 'none',
          border: 'none',
          cursor: 'pointer',
          color: 'inherit',
          fontSize: 'inherit',
          fontFamily: 'inherit',
          padding: '4px 16px',
          textAlign: 'left',
        }}
        type='button'
      >
        {_('Delete')}
      </button>
      {showWarning && (
        <Modal
          open={showWarning}
          onClose={() => setShowWarning(false)}
          title={_('Warning')}
          buttons={[
            {
              label: _('Cancel'),
              onClick: () => setShowWarning(false),
              variant: 'outlined' as const,
            },
            {
              label: _('Continue'),
              onClick: handleWarningAccept,
              variant: 'solid' as const,
              autoFocus: true,
            },
          ]}
        >
          <strong style={{ color: 'orange' }}>
            {_(
              'This action will delete the {{count}} DDI linked to the client, unlink them first if you want to keep them',
              { count: ddisCount }
            )}
          </strong>
        </Modal>
      )}
      {proceedToDelete && (
        <div ref={deleteButtonRef} style={{ display: 'none' }}>
          <DeleteRowButton row={row} entityService={entityService} />
        </div>
      )}
    </>
  );
};

export default DeleteButtonWithWarning;
