package com.studentdata.common;

import org.hibernate.SessionFactory;
import org.hibernate.boot.registry.StandardServiceRegistryBuilder;
import org.hibernate.cfg.Configuration;
import org.hibernate.service.ServiceRegistry;
import org.hibernate.service.ServiceRegistryBuilder;

/**
 * @author Tony Phan. This class is the utility used to get the session factory.
 */
public class HibernateHelper {
  private static SessionFactory sessionFactory;
  
  /**
   * Get the session factory.
   */
  public static SessionFactory getSessionFactory() {
    if (sessionFactory == null || sessionFactory.isClosed()) {
      // loads configuration and mappings
      Configuration configuration = new Configuration().configure();
      ServiceRegistry serviceRegistry = new StandardServiceRegistryBuilder()
                    .applySettings(configuration.getProperties()).build();
      // builds a session factory from the service registry
      sessionFactory = configuration.buildSessionFactory(serviceRegistry);
    }
    return sessionFactory;
  }
}
