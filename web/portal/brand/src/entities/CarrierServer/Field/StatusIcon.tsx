import { styled } from '@mui/styles';
import DoneIcon from '@mui/icons-material/Done';
import WarningAmberIcon from '@mui/icons-material/WarningAmber';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { CarrierServerPropertyList } from '../CarrierServerProperties';

type ScalarRowTypes = CarrierServerPropertyList<boolean>;
type StatusIconProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ScalarRowTypes, any>
>;

const StatusIcon: StatusIconProps = (props): JSX.Element | null => {
  const { values } = props;

  if (values?.status?.registered) {
    const StyledDoneIcon = styled(DoneIcon)(() => {
      return { verticalAlign: 'bottom' };
    });

    return <StyledDoneIcon />;
  }

  const StyledWarningIcon = styled(WarningAmberIcon)(() => {
    return { verticalAlign: 'bottom' };
  });

  return <StyledWarningIcon />;
};

export default StatusIcon;
