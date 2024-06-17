import DialogContentBody from '@irontec-voip/ivoz-ui/components/Dialog/DialogContentBody';
import ErrorMessageComponent from '@irontec-voip/ivoz-ui/components/ErrorMessageComponent';
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
import EmojiFlagsIcon from '@mui/icons-material/EmojiFlags';
import {
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  FormHelperText,
  Tooltip,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions } from 'store';

import BannedAddressBruteForce from '../BannedAddressBruteForce';

const Unban: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');

  const apiDelete = useStoreActions((store) => store.api.delete);

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleSubmit = () => {
    apiDelete({
      path: `${BannedAddressBruteForce.path}/antibruteforce/${row.id}`,
      handleErrors: false,
    })
      .then(() => {
        setOpen(false);
        setError(false);
      })
      .catch((error: { statusText: string; status: number }) => {
        setErrorMsg(`${error.statusText} (${error.status})`);
        setError(true);
      });
  };

  const handleClose = () => {
    setOpen(false);
    setError(false);
  };

  return (
    <>
      <a onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem>{_('Unban address')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Unban address')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta>
                <EmojiFlagsIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle>{_('Unban address')}</DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!error && (
              <DialogContentBody
                child={
                  <FormHelperText>
                    {_('Unban IP <strong>{{ip}}</strong>', { ip: row.ip })}
                  </FormHelperText>
                }
              />
            )}
            {error && <ErrorMessageComponent message={errorMsg} />}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>Cancel</OutlinedButton>
            {!error && (
              <SolidButton autoFocus onClick={handleSubmit}>
                {_('Accept')}
              </SolidButton>
            )}
          </DialogActions>
        </Dialog>
      )}
    </>
  );
};

export default Unban;
