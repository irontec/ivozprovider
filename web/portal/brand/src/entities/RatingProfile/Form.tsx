import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import store from 'store';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const Retail = store.getState().entities.entities.Retail;
  const Wholesale = store.getState().entities.entities.Wholesale;

  const isRetailPath =
    match.pattern.path.indexOf(Retail.localPath || '_') === 0;
  const isWholesalePath =
    match.pattern.path.indexOf(Wholesale.localPath || '_') === 0;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['activationTime'],
    },
    {
      legend: '',
      fields: [
        'ratingPlanGroup',
        (isRetailPath || isWholesalePath) && 'routingTag',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
