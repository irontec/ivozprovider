import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import store from 'store';

import { CompanyPropertyList } from '../CompanyProperties';

type RouteTypeValues = CompanyPropertyList<string>;
type RouteTypeProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<RouteTypeValues>
>;

const TypeIcon: RouteTypeProps = (props): JSX.Element | null => {
  const { values } = props;
  const { type } = values;

  const entities = store.getState().entities.entities;

  switch (type) {
    case 'vpbx':
      return <entities.VirtualPbx.icon />;
    case 'retail':
      return <entities.Retail.icon />;
    case 'wholesale':
      return <entities.Wholesale.icon />;
    case 'residential':
      return <entities.Residential.icon />;
    default:
      return null;
  }
};

export default TypeIcon;
