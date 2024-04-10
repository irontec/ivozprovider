import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReplayIcon from '@mui/icons-material/Replay';
import {
  Dialog,
  DialogActions,
  DialogContent,
  DialogContentText,
  DialogTitle,
  Tooltip,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import FaxesOut from '../FaxesOut';

const Resend: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;
  const [open, setOpen] = useState(false);
  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });

  if (!row) {
    return null;
  }

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSend = () => {
    apiPost({
      path: `${FaxesOut.path}/${row.id}/resend`,
      values: {},
      contentType: 'text/plain',
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  return (
    <>
      {variant === 'text' && (
        <MoreMenuItem onClick={handleClickOpen}>{_('Resend fax')}</MoreMenuItem>
      )}
      {variant === 'icon' && (
        <Tooltip
          title={_('Resend fax')}
          placement='bottom-start'
          enterTouchDelay={0}
        >
          <span>
            <StyledTableRowCustomCta disabled={row.status !== 'error'}>
              <ReplayIcon onClick={handleClickOpen} color='primary' />
            </StyledTableRowCustomCta>
          </span>
        </Tooltip>
      )}

      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby='alert-dialog-title'
        aria-describedby='alert-dialog-description'
      >
        <DialogTitle id='alert-dialog-title'>{_('Resend fax?')}</DialogTitle>
        <DialogContent>
          <DialogContentText id='alert-dialog-description'>
            {_('You are about to resend this fax')}
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <OutlinedButton onClick={handleClose}>{_('Cancel')}</OutlinedButton>
          <SolidButton onClick={handleSend} autoFocus>
            {_('Resend')}
          </SolidButton>
        </DialogActions>
      </Dialog>
    </>
  );
};

export default Resend;
