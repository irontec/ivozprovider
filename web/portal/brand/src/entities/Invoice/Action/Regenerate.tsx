import { MoreMenuItem } from '@irontec-voip/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec-voip/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec-voip/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec-voip/ivoz-ui/router/routeMapParser';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
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

import Invoice from '../Invoice';

const Regenerate: ActionFunctionComponent = (props: ActionItemProps) => {
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
      path: `${Invoice.path}/${row.id}/regenerate`,
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
        <MoreMenuItem onClick={handleClickOpen}>
          {_('Regenerate invoice')}
        </MoreMenuItem>
      )}
      {variant === 'icon' && (
        <Tooltip
          title={_('Regenerate invoice')}
          placement='bottom-start'
          enterTouchDelay={0}
        >
          <StyledTableRowCustomCta>
            <ReplayIcon onClick={handleClickOpen} color='primary' />
          </StyledTableRowCustomCta>
        </Tooltip>
      )}

      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby='alert-dialog-title'
        aria-describedby='alert-dialog-description'
      >
        <DialogTitle id='alert-dialog-title'>
          {_('Regenerate invoice?')}
        </DialogTitle>
        <DialogContent>
          <DialogContentText id='alert-dialog-description'>
            {_(
              "You're about to regenerate invoice <strong>{{number}}</strong>",
              { number: row.number }
            )}
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <OutlinedButton onClick={handleClose}>Cancel</OutlinedButton>
          <SolidButton onClick={handleSend} autoFocus>
            {_('Send')}
          </SolidButton>
        </DialogActions>
      </Dialog>
    </>
  );
};

export default Regenerate;
