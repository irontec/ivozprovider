import { PropertyList, ScalarProperty } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';
import { ClientFeatures } from 'store/clientSession/aboutMe';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;
  const { entityService, row, match, properties } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const newProperties = { ...properties } as PropertyList;
  const endpointType = {
    ...properties.endpointType,
    enum: { ...properties.endpointType.enum },
  } as ScalarProperty;
  const hasFaxesFeature = aboutMe?.features.includes(ClientFeatures.faxes);
  if (!hasFaxesFeature) {
    delete endpointType.enum.fax;
  }
  const hasFriendsFeature = aboutMe?.features.includes(ClientFeatures.friends);
  if (!hasFriendsFeature) {
    delete endpointType.enum.friend;
  }
  newProperties.endpointType = endpointType;

  entityService.replaceProperties(newProperties);

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Information'),
      fields: ['name', 'email'],
    },
    {
      legend: _('Time Information'),
      fields: [
        'frequency',
        'unit',
        edit && 'nextExecution',
        edit && 'lastExecution',
      ],
    },
    {
      legend: _('Filters'),
      fields: [
        'callDirection',
        'ddi',
        'endpointType',
        aboutMe?.vpbx && 'user',
        aboutMe?.retail && 'retailAccount',
        aboutMe?.residential && 'residentialDevice',
        hasFaxesFeature && 'fax',
        hasFriendsFeature && 'friend',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
