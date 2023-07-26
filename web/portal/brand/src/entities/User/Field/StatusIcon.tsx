import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import WarningAmberIcon from '@mui/icons-material/WarningAmber';
import { Tooltip } from '@mui/material';
import { styled } from '@mui/styles';

import RetailAccountStatusIcon, {
  StatusIconValues,
} from '../../RetailAccount/Field/StatusIcon';
import { UserPropertyList } from '../UserProperties';

type ScalarRowTypes = UserPropertyList<string | boolean>;
type StatusIconProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<
    ScalarRowTypes,
    Record<string, string | StatusIconValues>
  >
>;

const StatusIcon: StatusIconProps = (props): JSX.Element | null => {
  const { values } = props;

  if (values.terminal) {
    return (
      <RetailAccountStatusIcon {...props} values={values as StatusIconValues} />
    );
  }

  const StyledIcon = styled(WarningAmberIcon)(() => {
    return { verticalAlign: 'bottom' };
  });

  return (
    <Tooltip title={_('No terminal assigned')} enterTouchDelay={0}>
      <StyledIcon />
    </Tooltip>
  );
};

export default StatusIcon;
