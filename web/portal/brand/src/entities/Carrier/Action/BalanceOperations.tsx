import { EntityValues } from '@irontec/ivoz-ui';
import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  OutlinedButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import { StyledDropdown } from '@irontec/ivoz-ui/services/form/Field/Dropdown/Dropdown.styles';
import { StyledTextField } from '@irontec/ivoz-ui/services/form/Field/TextField/TextField.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReplayIcon from '@mui/icons-material/Replay';
import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
  SelectChangeEvent,
  Tooltip,
} from '@mui/material';
import { useEffect, useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import { CompanyPropertyList } from '../../Company/CompanyProperties';
import { CurrencyPropertyList } from '../../Currency/CurrencyProperties';
import Carrier from '../Carrier';

const amountChoices = [
  { id: '+', label: '+', operation: 'increment' },
  { id: '-', label: '-', operation: 'decrement' },
];

const BalanceOperations: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row, variant = 'icon' } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const hasBillingFeature = aboutMe?.features.includes('billing') ?? false;

  const [amountChoice, setAmountChoice] = useState(amountChoices[0].id);
  const [amountValue, setAmountValue] = useState('0.00');
  const [open, setOpen] = useState(false);
  const [currencySymbol, setCurrencySymbol] = useState('');
  const apiPost = useStoreActions((actions) => {
    return actions.api.post;
  });
  const cancelToken = useCancelToken();

  const apiGet = useStoreActions((actions) => {
    return actions.api.get;
  });
  const reload = useStoreActions((actions) => {
    return actions.list.reload;
  });
  useEffect(() => {
    apiGet({
      path: `${Carrier.path}/${row.id}`,
      params: {},
      successCallback: async (value) => {
        const typedValue = value as CompanyPropertyList<EntityValues>;
        if (!typedValue.currency) {
          return;
        }

        const { symbol } = typedValue.currency as CurrencyPropertyList<
          string | null
        >;
        setCurrencySymbol(symbol ?? '');

        return;
      },
      cancelToken: cancelToken[1],
    });
  }, [setCurrencySymbol, row.id, apiGet, cancelToken]);

  const handleClickOpen = () => {
    if (!hasBillingFeature) {
      return;
    }
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

  const handleSend = () => {
    const operation = amountChoices.find((choice) => choice.id === amountChoice)
      ?.operation as string;

    apiPost({
      path: `${Carrier.path}/${row.id}/modify_balance`,
      values: {
        operation,
        amount: amountValue,
      },
      contentType: 'application/x-www-form-urlencoded',
    }).then(() => {
      setOpen(false);
      reload();
    });
  };

  if (!row || !hasBillingFeature) {
    return null;
  }

  if (!row.calculateCost) {
    return (
      <MoreMenuItem>
        <a className='disabled'>{_('Balance Operations')}</a>
      </MoreMenuItem>
    );
  }

  return (
    <>
      {variant === 'text' && (
        <MoreMenuItem onClick={handleClickOpen}>
          {_('Balance Operations')}
        </MoreMenuItem>
      )}
      {variant === 'icon' && (
        <Tooltip
          title={_('Balance Operations')}
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
        <DialogTitle id='alert-dialog-title'>{_('Add Balance')}</DialogTitle>
        <DialogContent>
          <Box
            sx={{
              display: 'flex',
            }}
          >
            <Box
              sx={{
                display: 'flex',
                alignItems: 'center',
                alignContent: 'center',
              }}
            >
              <label>{_('Amount')}</label>
              <StyledDropdown
                choices={amountChoices}
                name='Amount'
                label={''}
                sx={{
                  width: 100,
                  marginLeft: 4,
                }}
                value={amountChoice}
                required={false}
                disabled={false}
                onChange={function (event: SelectChangeEvent): void {
                  const target = event.target;
                  setAmountChoice(target?.value);
                }}
                onBlur={function (): void {
                  return;
                }}
                hasChanged={false}
              />
            </Box>
            <Box
              sx={{
                display: 'flex',
                alignItems: 'center',
                alignContent: 'center',
              }}
            >
              <StyledTextField
                sx={{ marginLeft: 4, marginRight: 2 }}
                type='text'
                value={amountValue}
                onChange={(event) => {
                  const { value } = event.target;
                  const validAmount = new RegExp(
                    '^(?:\\d+(?:\\.\\d*)?|\\d*\\.\\d*)?$'
                  );

                  if (value.match(validAmount)) {
                    setAmountValue(value);
                  }
                }}
                hasChanged={false}
              />
              <label>{currencySymbol}</label>
            </Box>
          </Box>
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

export default BalanceOperations;
