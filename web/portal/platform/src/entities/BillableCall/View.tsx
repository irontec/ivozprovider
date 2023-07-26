import { FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import DefaultView from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/View';
import { ViewProps } from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const View = (props: ViewProps): JSX.Element | null => {
  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Information'),
      fields: [
        'brand',
        'company',
        'startTime',
        'duration',
        'direction',
        'caller',
        'callee',
      ],
    },
    {
      legend: _('Billing Information'),
      fields: [
        'price',
        'cost',
        'ratingPlanName',
        'destinationName',
        'carrier',
        'ddiProvider',
        'invoice',
      ],
    },
    {
      legend: _('Extra Information'),
      fields: ['callid', 'endpointType', 'endpointId', 'endpointName'],
    },
  ];

  return <DefaultView {...props} groups={groups} />;
};

export default View;
