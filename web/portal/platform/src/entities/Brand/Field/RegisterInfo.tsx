import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui';
import { BrandPropertyList } from '../BrandProperties';

type RouteTypeValues = BrandPropertyList<string>;
type RouteTypeProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<RouteTypeValues>
>;

const RegisterInfo: RouteTypeProps = (props): JSX.Element => {
  const { values } = props;

  return <>{(values.invoice as Record<string, string>).registryData}</>;
};

export default RegisterInfo;
