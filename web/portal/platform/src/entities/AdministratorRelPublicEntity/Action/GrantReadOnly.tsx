import { ApiError } from '@irontec-voip/ivoz-ui';
import { MoreMenuItem } from '@irontec-voip/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec-voip/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec-voip/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec-voip/ivoz-ui/router/routeMapParser';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import ReceiptLongIcon from '@mui/icons-material/ReceiptLong';
import {
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  Tooltip,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

const GrantReadOnly: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { rows, selectedValues = [], variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>();

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
    const path = `${administrators.path}/${administratorId}/grant_read_only`;
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
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
      .catch((error: ApiError) => {
        const errorMsg =
          error?.data?.detail ?? `${error?.statusText} (${error?.status})`;
        setErrorMsg(errorMsg);
        setError(true);
      });
  };

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  return (
    <>
      <span className={disabled ? 'disabled' : ''} onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem onClick={handleClickOpen}>
            {_('Grant Read Only Access')} ({selectedValues.length})
          </MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={`_('Grant Read Only Access') ${selectedValues.length}`}
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
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle id='alert-dialog-title'>
            {_('Grant Read Only Access')}
          </DialogTitle>
          <DialogContent sx={{ textAlign: 'center!important' }}>
            {_('Do you really want to grant read access to selected entities?')}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>{_('Cancel')}</OutlinedButton>
            {!error && (
              <SolidButton onClick={handleUpdate} autoFocus>
                {_('Accept')}
              </SolidButton>
            )}
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default GrantReadOnly;
