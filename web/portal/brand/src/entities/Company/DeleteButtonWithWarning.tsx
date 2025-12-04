import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import EntityService from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useEffect, useRef, useState } from 'react';

interface DeleteButtonWithWarningProps {
  row: Record<string, unknown>;
  entityService: EntityService;
}

const DeleteButtonWithWarning = ({
  row,
  entityService,
}: DeleteButtonWithWarningProps) => {
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

  if (proceedToDelete) {
    return (
      <div ref={deleteButtonRef}>
        <DeleteRowButton row={row} entityService={entityService} />
      </div>
    );
  }

  return (
    <>
      <button
        onClick={(e) => {
          e.preventDefault();
          e.stopPropagation();
          setShowWarning(true);
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
              'This action will delete the DDIs linked to the client, unlink them first if you want to keep them'
            )}
          </strong>
        </Modal>
      )}
    </>
  );
};

export default DeleteButtonWithWarning;
