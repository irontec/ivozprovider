import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import store from 'store';

import { ClientTypes } from '../ClientFeatures';
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
    case ClientTypes.vpbx:
      return <entities.VirtualPbx.icon />;
    case ClientTypes.retail:
      return <entities.Retail.icon />;
    case ClientTypes.wholesale:
      return <entities.Wholesale.icon />;
    case ClientTypes.residential:
      return <entities.Residential.icon />;
    default:
      return null;
  }
};

export default TypeIcon;
