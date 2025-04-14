import { isEntityItem } from '@irontec/ivoz-ui';
import ChildEntityLink from '@irontec/ivoz-ui/components/List/Content/Shared/ChildEntityLink';
import DefaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleIcon from '@mui/icons-material/ChatBubble';
import { IvozStoreState } from 'store';

import Recording from '../Recording/Recording';
import Actions from './Action';
import { BillableCallProperties } from './BillableCallProperties';

const properties: BillableCallProperties = {
  startTime: {
    label: _('Start time'),
  },
  callid: {
    label: _('Call ID'),
  },
  caller: {
    label: _('Caller'),
  },
  callee: {
    label: _('Callee'),
  },
  destinationName: {
    label: _('Destination'),
  },
  direction: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
  },
  invoice: {
    label: _('Invoice', { count: 1 }),
  },
  price: {
    label: _('Price'),
  },
  duration: {
    label: _('Duration'),
  },
  cost: {
    label: _('Cost'),
  },
  carrierName: {
    label: _('Carrier'),
  },
  ratingPlanName: {
    label: _('Rating plan', { count: 1 }),
  },
  endpointType: {
    label: _('Endpoint type'),
  },
  endpointId: {
    label: _('Endpoint id'),
  },
  endpointName: {
    label: _('Endpoint name'),
  },
  ddiProvider: {
    label: _('DDI Provider'),
  },
};

const columns = (store: IvozStoreState) => {
  const billingInfo = store.clientSession.aboutMe.profile?.billingInfo;

  const response = [
    'startTime',
    'direction',
    'caller',
    'callee',
    'duration',
    billingInfo && 'price',
  ];

  return response.filter((column) => column !== false) as Array<string>;
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  const isRecordingPath =
    isEntityItem(routeMapItem) && routeMapItem.entity.iden === Recording.iden;
  const callHasRecordings = row.numRecordings > 0;

  if (isRecordingPath && !callHasRecordings) {
    return (
      <ChildEntityLink row={row} routeMapItem={routeMapItem} disabled={true} />
    );
  }

  return DefaultChildDecorator(props);
};

const billableCall: EntityInterface = {
  ...DefaultEntityBehavior,
  icon: ChatBubbleIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/calls/external_calls.html',
  iden: 'BillableCall',
  title: _('External call', { count: 2 }),
  path: '/billable_calls',
  properties,
  columns,
  customActions: Actions,
  acl: {
    ...DefaultEntityBehavior.acl,
    iden: 'BillableCalls',
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  View: async () => {
    const module = await import('./View');

    return module.default;
  },
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
  ChildDecorator,
};

export default billableCall;
