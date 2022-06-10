import useFkChoices from "@irontec/ivoz-ui/entities/data/useFkChoices";
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";
import { PropertyList } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { foreignKeyGetter } from "./foreignKeyGetter";
import User from "../User/User";
import Friend from "../Friend/Friend";
import RetailAccount from "../RetailAccount/RetailAccount";
import ResidentialDevice from "../ResidentialDevice/ResidentialDevice";
import { useStoreState } from "store";

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const skip: Array<string> = [];
  if (aboutMe?.vpbx) {
    skip.push(...["cfwToRetailAccount", "residentialDevice"]);
  }

  if (aboutMe?.residential) {
    skip.push(...["cfwToRetailAccount", "extension"]);
  }

  if (aboutMe?.retail) {
    skip.push(...["residentialDevice", "extension", "voicemail"]);
  }

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
    skip,
  });

  const newProperties = { ...properties };

  const userPath = match.path.includes(User.path);
  const friendPath = match.path.includes(Friend.path);
  const retailAccountPath = match.path.includes(RetailAccount.path);
  const residentialDevicePath = match.path.includes(ResidentialDevice.path);

  if (!retailAccountPath) {
    delete newProperties.cfwToRetailAccount;
    delete newProperties.ddi;
  }

  if (!residentialDevicePath) {
    delete newProperties.residentialDevice;
  }

  if (!userPath) {
    delete newProperties.user;
  }

  if (!friendPath) {
    delete newProperties.friend;
  }

  entityService.replaceProperties(newProperties as PropertyList);

  const groups: Array<FieldsetGroups> = [
    {
      legend: "",
      fields: [
        "enabled",
        !aboutMe?.retail && "callTypeFilter",
        aboutMe?.retail && "ddi",
        "callForwardType",
        "noAnswerTimeout",
        "targetType",
        aboutMe?.vpbx && "extension",
        (aboutMe?.vpbx || aboutMe?.residential) && "voicemail",
        "numberCountry",
        "numberValue",
        aboutMe?.retail && "cfwToRetailAccount",
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
