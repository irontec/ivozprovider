import DialogContentBody from '@irontec/ivoz-ui/components/Dialog/DialogContentBody';
import ErrorMessageComponent from '@irontec/ivoz-ui/components/ErrorMessageComponent';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import EmojiFlagsIcon from '@mui/icons-material/EmojiFlags';
import { FormHelperText, Tooltip } from '@mui/material';
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

  const customButtons = [
    {
      label: _('Cancel'),
      onClick: handleClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Accept'),
      onClick: handleSubmit,
      variant: 'solid' as const,
      autoFocus: true,
      disabled: !error,
    },
  ];

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
        <Modal
          open={open}
          onClose={handleClose}
          title={_('Unban address')}
          buttons={customButtons}
          keepMounted={true}
        >
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
        </Modal>
      )}
    </>
  );
};

export default Unban;
