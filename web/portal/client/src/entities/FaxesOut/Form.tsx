import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useStoreState } from 'store';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, initialValues, create } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (create) {
    initialValues.dstCountry = aboutMe?.defaultCountryId ?? null;
  }

  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: ['fax', 'file'],
    },
    {
      legend: '',
      fields: ['dstCountry', 'dst'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
