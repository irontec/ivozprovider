import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReceiptLongIcon from '@mui/icons-material/ReceiptLong';
import { Tooltip } from '@mui/material';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

const RevokeAll: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { rows, selectedValues = [], variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);

  const administrators = useStoreState(
    (state) => state.entities.entities.Administrator
  );

  const filteredRows = rows.filter((row) => {
    return selectedValues.includes(row.id.toString());
  });

  const entityIds = filteredRows.map((item) => item?.publicEntityId?.id);
  let disabled = true;

  if (selectedValues.length > 0) {
    disabled = false;
  }

  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });

  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });

  const handleClickOpen = () => {
    if (disabled) {
      return;
    }
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
    setError(false);
  };

  const administratorId =
    typeof rows[0]?.administrator === 'object'
      ? rows[0].administrator.id
      : null;

  const handleUpdate = () => {
    const payload = entityIds;
    const path = `${administrators.path}/${administratorId}/revoke_all`;
    const resp = apiPost({
      path,
      values: payload,
      contentType: 'application/json',
      silenceErrors: true,
    })
      .then(() => {
        setOpen(false);

        if (resp !== undefined) {
          setTimeout(() => {
            reload();
          });
        }
      })
      .catch(() => {
        setError(true);
      });
  };

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Accept'),
      onClick: handleUpdate,
      variant: 'solid' as const,
      autoFocus: true,
      disabled: error,
    },
  ];

  return (
    <>
      <span className={disabled ? 'disabled' : ''} onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem onClick={handleClickOpen}>
            {_('Revoke Access')} ({selectedValues.length})
          </MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={`_('Revoke Access') ${selectedValues.length}`}
            placement='bottom'
            enterTouchDelay={0}
          >
            <StyledTableRowCustomCta>
              <ReceiptLongIcon />
            </StyledTableRowCustomCta>
          </Tooltip>
        )}
      </span>
      {open && (
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Revoke Access')}
          buttons={customButtons}
          keepMounted={true}
        >
          {_('Do you really want to revoke access to selected entities?')}
        </Modal>
      )}
    </>
  );
};

export default RevokeAll;
