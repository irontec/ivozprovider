import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'callid',
        'startTime',
        'duration',
        'caller',
        'callee',
        'cost',
        'price',
        'carrierName',
        'destinationName',
        'ratingPlanName',
        'endpointType',
        'endpointId',
        'endpointName',
        'direction',
        'id',
        'company',
        'carrier',
        'destination',
        'ratingPlanGroup',
        'invoice',
        'ddi',
        'ddiProvider',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
