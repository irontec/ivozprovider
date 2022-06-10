import genericForeignKeyResolver, {
  remapFk,
} from "@irontec/ivoz-ui/services/api/genericForeigKeyResolver";
import entities from "../index";
import { DdiPropertiesList } from "./DdiProperties";
import { foreignKeyResolverType } from "@irontec/ivoz-ui/entities/EntityInterface";
import { autoForeignKeyResolver } from "@irontec/ivoz-ui/entities/DefaultEntityBehavior";

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<DdiPropertiesList> {
  const { Country } = entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    entities,
    skip: ["country"],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: "country",
      entity: Country,
      addLink: false,
      cancelToken,
    })
  );

  await Promise.all(promises);

  if (!Array.isArray(data)) {
    return data;
  }

  for (const idx in data) {
    switch (data[idx].routeType) {
      case "user":
        remapFk(data[idx], "user", "target");
        break;
      case "ivr":
        remapFk(data[idx], "ivr", "target");
        break;
      case "huntGroup":
        remapFk(data[idx], "huntGroup", "target");
        break;
      case "fax":
        remapFk(data[idx], "fax", "target");
        break;
      case "conferenceRoom":
        remapFk(data[idx], "conferenceRoom", "target");
        break;
      case "friend":
        remapFk(data[idx], "friendValue", "target");
        break;
      case "queue":
        remapFk(data[idx], "queue", "target");
        break;
      case "residential":
        remapFk(data[idx], "residentialDevice", "target");
        break;
      case "conditional":
        remapFk(data[idx], "conditionalRoute", "target");
        break;
      case "retail":
        remapFk(data[idx], "retailAccount", "target");
        break;
      default:
        console.error("Unkown route type " + data[idx].routeType);
        data[idx].target = "";
        break;
    }

    delete data[idx].user;
    delete data[idx].ivr;
    delete data[idx].huntGroup;
    delete data[idx].fax;
    delete data[idx].conferenceRoom;
    delete data[idx].residentialDevice;
    delete data[idx].friendValue;
    delete data[idx].queue;
    delete data[idx].conditionalRoute;
    delete data[idx].retailAccount;
  }

  return data;
};

export default foreignKeyResolver;
