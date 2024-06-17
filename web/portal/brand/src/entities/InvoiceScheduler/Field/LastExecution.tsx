import { ScalarProperty } from '@irontec-voip/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec-voip/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import DoneIcon from '@mui/icons-material/Done';
import WarningAmberIcon from '@mui/icons-material/WarningAmber';
import { Tooltip } from '@mui/material';
import { styled } from '@mui/styles';
import { ReactNode } from 'react';

import { InvoiceSchedulerPropertyList } from '../InvoiceSchedulerProperties';

type LastExecutionValues = InvoiceSchedulerPropertyList<string>;
type lastExecutionProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<LastExecutionValues>
>;

const LastExecution: lastExecutionProps = (props): JSX.Element | null => {
  const { _context, _columnName, property, values, formFieldFactory } = props;

  if (_context === 'read' || !formFieldFactory) {
    const Icon = values.lastExecutionError ? WarningAmberIcon : DoneIcon;

    const tooltipMsg = !values.lastExecutionError
      ? _('Successful execution')
      : values.lastExecutionError;

    const StyledIcon = styled(Icon)(() => {
      return { verticalAlign: 'text-bottom' };
    });

    return (
      <>
        {values.lastExecution}
        <Tooltip
          title={tooltipMsg as ReactNode}
          placement='bottom-start'
          enterTouchDelay={0}
        >
          <StyledIcon />
        </Tooltip>
      </>
    );
  }

  const { choices, readOnly } = props;
  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default LastExecution;
