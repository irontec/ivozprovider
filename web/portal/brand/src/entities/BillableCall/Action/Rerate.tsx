import { EntityValues } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';
import ErrorIcon from '@mui/icons-material/Error';
import {
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  Tooltip,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import { ClientFeatures } from '../../Company/ClientFeatures';
import BillableCall from '../BillableCall';

const UpdateLicenses: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { selectedValues = [], variant = 'icon' } = props;
  const profile = useStoreState((state) => state.clientSession.aboutMe.profile);

  const hasBillingFeature =
    profile?.features?.includes(ClientFeatures.billing) || false;
  const disabled = !hasBillingFeature || selectedValues.length === 0;

  const [open, setOpen] = useState(false);
  const [error, setError] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string>();

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

  const handleUpdate = () => {
    const resp = apiPost({
      path: `${BillableCall.path}/rerate`,
      values: selectedValues as unknown as EntityValues,
      contentType: 'application/json',
      silenceErrors: true,
    })
      .then(() => {
        setOpen(false);

        if (resp !== undefined) {
          reload();
        }
      })
      .catch(
        (error: {
          statusText: string;
          status: number;
          data?: Record<string, string>;
        }) => {
          const errorMsg =
            error?.data?.detail ?? `${error.statusText} (${error.status})`;
          setErrorMsg(errorMsg);
          setError(true);
        }
      );
  };

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  return (
    <>
      <a className={disabled ? 'disabled' : ''} onClick={handleClickOpen}>
        {variant === 'text' && (
          <MoreMenuItem onClick={handleClickOpen}>
            {_('Rerate calls')}
          </MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Rerate calls')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta disabled={disabled}>
                <CurrencyExchangeIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </a>
      {open && (
        <Dialog open={open} onClose={handleClose} keepMounted>
          <DialogTitle>{_('Rerate calls')}</DialogTitle>
          <DialogContent sx={{ textAlign: 'left!important' }}>
            {!error && (
              <>
                <p>
                  {_("You're about to rerate {{callNum}} call", {
                    callNum: selectedValues.length,
                    count: selectedValues.length,
                  })}
                </p>
              </>
            )}
            {error && (
              <span>
                <ErrorIcon
                  sx={{
                    verticalAlign: 'bottom',
                  }}
                />
                {errorMsg ?? 'There was a problem'}
              </span>
            )}
          </DialogContent>
          <DialogActions>
            <OutlinedButton onClick={handleClose}>Cancel</OutlinedButton>
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

export default UpdateLicenses;
