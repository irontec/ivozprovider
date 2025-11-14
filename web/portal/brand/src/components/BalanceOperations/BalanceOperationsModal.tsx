import Modal from '@irontec/ivoz-ui/components/shared/Modal/Modal';
import { StyledDropdown } from '@irontec/ivoz-ui/services/form/Field/Dropdown/Dropdown.styles';
import { StyledTextField } from '@irontec/ivoz-ui/services/form/Field/TextField/TextField.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { SelectChangeEvent } from '@mui/material';

type BalanceOperationsModalProps = {
  open: boolean;
  onClose: () => void;
  onSend: () => void;
  amountChoice: string;
  onAmountChoiceChange: (value: string) => void;
  amountValue: string;
  onAmountValueChange: (value: string) => void;
  currencySymbol: string;
};

const amountChoices = [
  { id: '+', label: '+', operation: 'increment' },
  { id: '-', label: '-', operation: 'decrement' },
];

const validAmountRegex = /^(?:\d+(?:\.\d*)?|\d*\.\d*)?$/;

export const BalanceOperationsModal = ({
  open,
  onClose,
  onSend,
  amountChoice,
  onAmountChoiceChange,
  amountValue,
  onAmountValueChange,
  currencySymbol,
}: BalanceOperationsModalProps) => {
  const customButtons = [
    {
      label: 'Cancel',
      onClick: onClose,
      variant: 'outlined' as const,
      autoFocus: false,
    },
    {
      label: _('Send'),
      onClick: onSend,
      variant: 'solid' as const,
      autoFocus: true,
    },
  ];

  return (
    <Modal
      open={open}
      onClose={onClose}
      title={_('Add Balance')}
      buttons={customButtons}
      sx={{
        width: '100%',
        display: 'flex',
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between',
      }}
    >
      <label>{_('Amount')}</label>
      <StyledDropdown
        choices={amountChoices}
        name='Amount'
        label={''}
        sx={{
          maxWidth: 90,
        }}
        value={amountChoice}
        required={false}
        disabled={false}
        onChange={(event: SelectChangeEvent) => {
          onAmountChoiceChange(event.target.value);
        }}
        onBlur={() => {
          return;
        }}
        hasChanged={false}
      />
      <StyledTextField
        sx={{ width: '100%' }}
        type='text'
        value={amountValue}
        onChange={(event) => {
          const { value } = event.target;
          if (value.match(validAmountRegex)) {
            onAmountValueChange(value);
          }
        }}
        hasChanged={false}
      />
      <label>{currencySymbol}</label>
    </Modal>
  );
};
