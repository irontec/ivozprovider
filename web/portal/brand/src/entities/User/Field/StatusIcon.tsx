import { styled } from '@mui/styles';
import { Tooltip } from '@mui/material';
import WarningAmberIcon from '@mui/icons-material/WarningAmber';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { UserPropertyList } from '../UserProperties';
import RetailAccountStatusIcon from '../../RetailAccount/Field/StatusIcon';

type ScalarRowTypes = UserPropertyList<string | boolean>;
type StatusIconProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ScalarRowTypes, any>
>;

const StatusIcon: StatusIconProps = (props): JSX.Element | null => {
  const { values } = props;

  if (values.terminal) {
    return <RetailAccountStatusIcon {...props} values={values} />;
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
